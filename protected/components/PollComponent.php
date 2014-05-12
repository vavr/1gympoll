<?php
/**
 * Created by PhpStorm.
 * User: vavr
 * Date: 11.05.14
 * Time: 1:36
 */

class PollComponent extends CApplicationComponent
{
    protected $users = array();

    public function init()
    {
        $this->users = PollUser::model()->findAll();
    }

    public function getUserFromHash($pollId, $hash)
    {
        $poll = $this->getPoll($pollId);

        if (!$poll) {
            throw new PollException('Не найдено голосование');
        }

        $pollHash = $poll['hash'];
        foreach ($this->users as $user) {
            $userHash = $this->generateUserHash($user['email'], $pollHash);
            if ($userHash === $hash) {
                return $user;
            }
        }

        return false;
    }

    public function getPoll($id)
    {
        $model = Poll::model()->findByPk($id);

        return $model;
    }

    protected function generateUserHash($email, $blow)
    {
        return md5($email.$blow);
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function getHashForUserAndPoll($pollId, $user)
    {
        $poll = $this->getPoll($pollId);

        if (!$poll) {
            throw new PollException('Не найдено голосование');
        }

        $pollHash = $poll['hash'];
        $userHash = $this->generateUserHash($user['email'], $pollHash);
        return $userHash;
    }

    public function sendInvitesToPoll($pollId, $message = '')
    {
        /**
         * @var Poll $poll
         */
        $poll = Poll::model()->findByPk($pollId);

        foreach ($this->getUsers() as $user) {

            $partUrl = '&id='.$pollId.'&hash='.$this->getHashForUserAndPoll($pollId, $user);

            /**
             * @var Email $mailer
             */
            $mailer = Yii::app()->email;

            $mailer->from = Yii::app()->params['adminEmail'];
            $mailer->to = $user->email;
            $mailer->subject = 'Голосование '.$poll->name;
            $mailer->message = $message . ' http://'.Yii::app()->params['host'].'/index.php?r=poll/vote'.$partUrl;
            $mailer->send();
        }
    }

    public function importUsers($csvFileName, $delim = ',')
    {
        $return = array('errors' => array(), 'inserted' => 0, 'updated' => 0, 'total' => 0);

        $handle = fopen($csvFileName, 'r');

        $emailValidator = new CEmailValidator();

        while($row = fgetcsv($handle, null, $delim, '"')) {
            if (!empty($row[0]) && !empty($row[1]) && $emailValidator->validateValue($row[0])) {
                $return['total']++;
                $pollUser = PollUser::model()->findByAttributes(array('email' => $row[0]));
                $insert = false;
                if (!$pollUser) {
                    $insert = true;
                    $pollUser = new PollUser();
                }
                $pollUser->email = $row[0];
                $pollUser->name = $row[1];
                if (!$pollUser->save()) {
                    $return['errors'][$row[0]] = $pollUser->getErrors();
                } else {
                    $insert ? $return['inserted']++ : $return['updated']++;
                }
            }
        }

        fclose($handle);

        return $return;
    }
}

class PollException extends CException {}