<?php
namespace App\Mailer;

use Mail;
use Naux\Mail\SendCloudTemplate;

class Mailer
{
    /**
     * [sendTo sengcloud发送邮件]
     * @method sendTo
     * @param  [type]   $template [模板]
     * @param  [type]   $email    [发送地址]
     * @param  array    $data     [内容]
     * @return [type]             [description]
     * @auth   simontuo
     */
    public function sendTo($template, $email, array $data)
    {

        $content = new SendCloudTemplate($template, $data);

        Mail::raw($content, function ($message) use($email) {
            $message->from(config('mail.from.address'), config('mail.from.name'));

            $message->to($email);
        });
    }

}
