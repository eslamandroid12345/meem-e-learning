<?php
namespace App\Http\Services\Dashboard\DeviceToken;
use App\Http\Mail\SendReply;
use App\Jobs\SendFirebaseNotification;
use App\Models\Contact;
use App\Models\Course;
use App\Models\User;
use App\Models\DeviceToken;
use App\Repository\DeviceTokenRepositoryInterface;
use App\Repository\NotificationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mail;
use Illuminate\Http\Request;
use App\Http\Traits\NotificationManager;

class DeviceTokenService
{
    use NotificationManager;
    private DeviceTokenRepositoryInterface $devicetokenRepository;
//    private NotificationRepositoryInterface $notificationRepository;

    public function __construct(DeviceTokenRepositoryInterface $devicetokenRepository)
    {
        $this->devicetokenRepository = $devicetokenRepository;
//        $this->notificationRepository = $notificationRepository;
    }

    public function edit()
    {
        $courseshasusers = Course::whereHas('users')->get();
        $allcourses = Course::all();
        return view('dashboard.site.DeviceToken.edit' , ['courseshasusers' => $courseshasusers , 'allcourses' => $allcourses]);
    }

    public function sendsubscribe(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $course = Course::find($request->course_id);
            $usersIds = User::whereHas('courses')->whereHas('devicetokens')->pluck('id')->toArray();
            $devicetokens = DeviceToken::whereIn('user_id',$course->users->pluck('id')->toArray())->pluck('token')->toArray();
            $this->notify($devicetokens,$request->title,$request->content,$usersIds,'course',$course->id,true);
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.updated successfully')]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function sendnotsubscribe(Request $request)
    {
        DB::beginTransaction();
        try
        {

            SendFirebaseNotification::dispatch(
                $request->title,
                $request->content,
                $request->course_id != null ? 'course' : null,
                $request->course_id != null ? $request->course_id : null
            );

            DB::commit();
            return redirect()->back()->with(['success' => __('messages.updated successfully')]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function sendnotregister(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $devicetokens = DeviceToken::where('user_id','=',null)->pluck('token')->toArray();
            $this->notify($devicetokens,$request->title,$request->content);
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.updated successfully')]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function notify($deviceTokens,$title,$content,$usersIds=[],string $type=null, string $typecontent=null,$subscribe = false)
    {
        $notification = $this->preparePush($deviceTokens,$title,$content,$usersIds,$type,$typecontent,$subscribe);
        $headers = [
                        'Authorization: key=' . static::$serverApiKey,
                        'Content-Type: application/json',
                    ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $notification);
        curl_exec($ch);
    }

}
