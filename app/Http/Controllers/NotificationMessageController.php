<?php
/*
 * File name: NotificationMessageController.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Http\Controllers;

use App\DataTables\NotificationMessageDataTable;
use App\Http\Requests\CreateNotificationMessageRequest;
use App\Models\User;
use App\Notifications\BroadcastMessage;
use App\Repositories\NotificationMessageRepository;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use Prettus\Validator\Exceptions\ValidatorException;

class NotificationMessageController extends Controller
{
    /** @var  NotificationMessageRepository */
    private $notificationMessageRepository;


    public function __construct(NotificationMessageRepository $notificationMessageRepo)
    {
        parent::__construct();
        $this->notificationMessageRepository = $notificationMessageRepo;
    }

    /**
     * Display a listing of the NotificationMessage.
     *
     * @param NotificationMessageDataTable $notificationMessageDataTable
     * @return mixed
     */
    public function index(NotificationMessageDataTable $notificationMessageDataTable)
    {
        return $notificationMessageDataTable->render('notification_messages.index');
    }

    /**
     * Show the form for creating a new NotificationMessage.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('notification_messages.create')->with("customFields", false);
    }


    /**
     * Store a newly created NotificationMessage in storage.
     * @param CreateNotificationMessageRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateNotificationMessageRequest $request)
    {
        $input = $request->all();
        try {
            $notificationMessage = $this->notificationMessageRepository->create($input);

            // Send Notification to users
            Notification::send(User::all(), new BroadcastMessage($notificationMessage));
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.notification_message')]));

        return redirect(route('notificationMessages.index'));
    }

    /**
     * Display the specified Notification.
     *
     * @param string $id
     *
     * @return Application|RedirectResponse|Redirector|Response
     */
    public function show(string $id)
    {
        $notificationMessage = $this->notificationMessageRepository->findWithoutFail($id);

        if (empty($notificationMessage)) {
            Flash::error('Notification message not found');

            return redirect(route('notificationMessages.index'));
        }

        return view('notification_messages.show')->with('notificationMessage', $notificationMessage);
    }

    /**
     * Remove the specified NotificationMessage from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Redirector|Response
     */
    public function destroy($id)
    {
        $notificationMessage = $this->notificationMessageRepository->findWithoutFail($id);

        if (empty($notificationMessage)) {
            Flash::error('Notification message not found');

            return redirect(route('notificationMessages.index'));
        }

        $this->notificationMessageRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.notification_message')]));

        return redirect(route('notificationMessages.index'));
    }
}
