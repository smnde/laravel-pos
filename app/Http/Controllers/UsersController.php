<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepository;
use App\Services\UserService;

class UsersController extends Controller
{
    private $user;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

    public function index()
    {
        $users = $this->user->getAll();
        return view('pages.users', compact('users'));
    }
    
    public function store(StoreUserRequest $request, USerService $service)
    {
        $service->create($request->all());
        return redirect()->back()->with('success', 'User baru berhasil ditambahkan');
    }

    public function update(StoreUserRequest $request, UserService $service, $id)
    {
        $service->update($request->all(), $id);
        return response('success');
    }

    public function destroy(UserService $service, $id)
    {
        $service->delete($id);
        return response('success');
    }
}
