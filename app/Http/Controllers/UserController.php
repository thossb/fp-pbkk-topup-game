<?php

namespace App\Http\Controllers;

// use App\Models\User;
// use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use function Pest\Laravel\get;
use App\Http\Service\UserService;

// class UserController extends Controller
// {
//     public function createUser(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:100',
//             'email' => 'required|email|unique:user|max:50',
//             'role_id' => 'required|integer',
//             'password' => 'required|min:6',
//             'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//         ]);

//         $user = new User([
//             'name' => $validated['name'],
//             'email' => $validated['email'],
//             'role_id' => $validated['role_id'],
//             'password' => bcrypt($validated['password']),
//         ]);

//         if ($request->hasFile('profile_picture')) {
//             $fileName = time() . $request->file('profile_picture')->getClientOriginalName();
//             $path = $request->file('profile_picture')->storeAs('images', $fileName, 'public');
//             $user->profile_picture = $path;
//         }

//         $user->save();

//         return response()->json(['message' => 'User created successfully']);
//         //return redirect()->route('login')->with('status', 'User created successfully');
//     }

//     public function getUserList(Request $request)
//     {
//         $pagination = 6;
//         $query = User::query();

//         if ($request->has('query')) {
//             $search_text = $request->input('query');
//             $query->where(function ($q) use ($search_text) {
//                 $q->where('name', 'LIKE', "%$search_text%")
//                     ->orWhere('email', 'LIKE', "%$search_text%");
//             });
//         }

//         if ($request->has('sort_by')) {
//             $sort_by = $request->input('sort_by');
//             if ($sort_by === 'name_asc') {
//                 $query->orderBy('name', 'asc');
//             } elseif ($sort_by === 'name_desc') {
//                 $query->orderBy('name', 'desc');
//             }
//         } else {
//             $query->orderBy('name', 'asc');
//         }

//         $user = $query->paginate($pagination);

//         return response()->json([
//             'title' => 'User',
//             'user' => $user,
//             'query' => $request->input('query'),
//             'sort_by' => $request->input('sort_by'),
//         ]);

//         // return view('admin.user', [
//         //     'title' => 'User',
//         //     'user' => $user,
//         //     'query' => $request->input('query'),
//         //     'sort_by' => $request->input('sort_by'),
//         // ]);
//     }

//     public function editUser($id)
//     {
//         $user = User::find($id);

//         if (!$user) {
//             return response()->json(['error' => 'User not found'], 404);
//         }

//         return response()->json([
//             'title' => 'Edit User',
//             'user' => $user,
//         ]);

//         // return view('admin.editUser', [
//         //     'title' => 'Edit User',
//         //     'user' => $user,
//         // ]);
//     }

//     public function updateUser(Request $request, $id)
//     {
//         $user = User::find($id);

//         if (!$user) {
//             return response()->json(['error' => 'User not found'], 404);
//         }

//         $validated = $request->validate([
//             'name' => 'required|string|max:100',
//             'email' => 'required|email|unique:user,email,' . $user->id,
//             'role_id' => 'required|integer',
//         ]);

//         $user->name = $validated['name'];
//         $user->email = $validated['email'];
//         $user->role_id = $validated['role_id'];

//         $user->save();

//         return response()->json(['message' => 'User updated successfully']);
//         //return back()->with('status', 'User updated successfully');
//     }

//     public function photoUpload(Request $request, $id)
//     {
//         $user = User::find($id);

//         if (!$user) {
//             return response()->json(['error' => 'User not found'], 404);
//         }

//         $request->validate([
//             'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
//         ]);

//         if ($request->hasFile('profile_picture')) {
//             $picturePath = $request->file('profile_picture')->store('public/pictures');
//             $user->profile_picture = str_replace('public/', '', $picturePath);
//         }

//         if ($request->type === 'delete') {
//             $user->profile_picture = null;
//         }

//         $user->save();

//         return response()->json(['message' => "User's profile picture updated successfully"]);
//         //return back()->with('status', "User's profile picture updated successfully");
//     }

//     public function deleteUser($id)
//     {
//         $user = User::find($id);

//         if (!$user) {
//             return response()->json(['error' => 'User not found'], 404);
//         }

//         $user->delete();

//         return response()->json(['message' => 'User deleted successfully']);
//         //return redirect()->route('user.list')->with('status', 'User deleted successfully');
//     }
// }

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:user|max:50',
            'role_id' => 'required|integer',
            'password' => 'required|min:6',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = $this->userService->createUser([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
            'password' => bcrypt($validated['password']),
        ]);

        if ($request->hasFile('profile_picture')) {
            $fileName = time() . $request->file('profile_picture')->getClientOriginalName();
            $path = $request->file('profile_picture')->storeAs('images', $fileName, 'public');
            $this->userService->updateUserProfilePicture($user, $path);
        }

        return response()->json(['message' => 'User created successfully']);
    }

    public function getUserList(Request $request)
    {
        $query = $request->input('query', '');
        $users = $this->userService->getUserList($query);

        return response()->json([
            'title' => 'User',
            'users' => $users,
            'query' => $query,
        ]);
    }

    public function editUser($id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'title' => 'Edit User',
            'user' => $user,
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email,' . $user->id,
            'role_id' => 'required|integer',
        ]);

        $this->userService->updateUser($user, $validated);

        return response()->json(['message' => 'User updated successfully']);
    }

    public function photoUpload(Request $request, $id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $picturePath = $request->file('profile_picture')->store('public/pictures');
            $this->userService->updateUserProfilePicture($user, str_replace('public/', '', $picturePath));
        }

        if ($request->type === 'delete') {
            $this->userService->updateUserProfilePicture($user, null);
        }

        return response()->json(['message' => "User's profile picture updated successfully"]);
    }

    public function deleteUser($id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $this->userService->deleteUser($user);

        return response()->json(['message' => 'User deleted successfully']);
    }
}