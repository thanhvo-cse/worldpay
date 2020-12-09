<?php
namespace ThanhVo\Worldpay\Event;

/**
 * All listeners must implement this interface.
 *
 * `onEvent()` method is called from inside the subject.
 *
 * It allows execution of arbitrary logic at some point of subject's lifecycle:
 * when the subject gets initialized or the subject gets finalized.
 * Listeners are usually attached to only one type of event.
 */
interface ObserverInterface
{
    /**
     * @return string
     */
    public function getSubject(): string;

    /**
     * @param $data
     * @return mixed
     */
    public function onEvent($data);
}
