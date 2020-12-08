<?php
namespace ThanhVo\Worldpay\Event;

trait Dispatcher
{
    /**
     * @var array
     */
    protected $events = [];

    /**
     * @param ObserverInterface $listener
     */
    public function addEventObserver(ObserverInterface $listener)
    {
        $this->events[$listener->getSubject()] = $this->getEventObservers($listener->getSubject());
        array_push($this->events[$listener->getSubject()], $listener);

        $this->afterNewEventObserver($listener);
    }

    /**
     * @param ObserverInterface $listener
     */
    protected function afterNewEventObserver(ObserverInterface $listener)
    {
    }

    /**
     * @param string $subject
     * @param mixed $data
     */
    protected function dispatchEvent(string $subject, $data)
    {
        foreach ($this->getEventObservers($subject) as $listener) {
            $listener->onEvent($data);
        }
    }

    /**
     * @param string $subject
     * @return ObserverInterface[]
     */
    protected function getEventObservers(string $subject): array
    {
        return array_key_exists($subject, $this->events) ? $this->events[$subject] : [];
    }
}
