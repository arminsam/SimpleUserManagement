<?php namespace ASM\Listeners;

use Laracasts\Commander\Events\EventListener;
use ASM\Contexts\Comments\Events\NewCommentWasPosted;
use ASM\Contexts\Comments\Events\NewFilesWereAttached;
use ASM\Contexts\Employees\Employee;
use ASM\Contexts\Employees\Events\NewEmployeeWasRegistered;
use ASM\Contexts\Processes\Events\NewProcessWasInitiated;
use ASM\Contexts\Processes\Events\ProcessStatusWasUpdated;
use ASM\Contexts\Users\Events\AnonymousUserHasRegistered;
use ASM\Contexts\Users\Events\UserHasRegistered;

class EmailNotifier extends EventListener {

    /**
     * @param AnonymousUserHasRegistered $event
     */
    public function whenAnonymousUserHasRegistered(AnonymousUserHasRegistered $event)
    {
        \Queue::push(function($job) use ($event)
        {
            \Mail::send('emails.user.anonymous_user_has_registered', compact('event'), function($message) use ($event)
            {
                $subject = 'A new account has been registered for you';
                $message->to($event->user->email, $event->user->name)->subject($subject)
                    ->from('admin@'.\Config::get('app.domain'), 'Site Admin');
            });

            $job->delete();
        });
    }

    /**
     * @param UserHasRegistered $event
     */
    public function whenUserHasRegistered(UserHasRegistered $event)
    {
        \Queue::push(function($job) use ($event)
        {
            \Mail::send('emails.user.new_user_was_registered', compact('event'), function($message) use ($event)
            {
                $subject = 'A new account has been registered for you';
                $message->to($event->user->email, $event->user->name)->subject($subject)
                    ->from('admin@'.\Config::get('app.domain'), 'Site Admin');
            });

            $job->delete();
        });
    }

}