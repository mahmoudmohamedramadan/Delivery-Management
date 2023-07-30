<?php

namespace App\Listeners;

class DelegateListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $delegate = \App\Models\Delegate::create($event->data);
        // image uploaded using mutators.
        $car = \App\Models\Car::find(request('car_id'));
        $delegate->cars()->attach($car);

        #region SimilarToAttach
        // $delegate->cars()->detach($car);
        // $delegate->cars()->sync([1]);
        // $delegate->cars()->syncWithoutDetaching([1,2,3]);
        #endregion
    }
}
