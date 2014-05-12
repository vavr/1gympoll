<?php


class PollCommand extends CConsoleCommand
{
    public function actionGenerateHash($pollId)
    {
        Yii::app()->poll->sendInvitesToPoll($pollId);
    }
}