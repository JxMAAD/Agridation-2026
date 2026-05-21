<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teams;
use App\Models\Judges;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return $this->adminDashboard($user);
        }

        if ($user->hasRole('juri')) {
            return $this->juriDashboard($user);
        }

        abort(403, 'Unauthorized access.');
    }

    private function adminDashboard($user)
    {
        $pesertaUsers = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'juri']);
        })->with(['profile', 'roles'])->get();

        $users = $pesertaUsers->map(function ($u) {
            return [
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'role' => $u->getRoleNames()->first() ?? 'peserta',
                'status' => $u->profile->status ?? 'Not Filled',
            ];
        });

        $stats = [
            'total_users' => $pesertaUsers->count(),
            'pending_verifications' => \App\Models\Profile::where('status', 'pending')
                ->whereIn('user_id', $pesertaUsers->pluck('id'))
                ->count(),
            'total_teams' => Teams::count(),
        ];

        return Inertia::render('Admin/Dashboard', [
            'name' => $user->name,
            'role' => 'Admin',
            'users' => $users,
            'stats' => $stats,
        ]);
    }

    private function juriDashboard($user)
    {
        // Get competitions assigned to this judge
        $assignedCompetitionIds = Judges::where('user_id', $user->id)
            ->pluck('competition_id');

        // Fetch teams in those competitions with verified leaders
        $teams = Teams::whereIn('competition_id', $assignedCompetitionIds)
            ->with(['leader.profile', 'competition'])
            ->get()
            ->filter(function ($team) {
                // Ensure the leader is approved
                return $team->leader && $team->leader->profile && $team->leader->profile->status === 'approved';
            })
            ->map(function ($team) {
                return [
                    'id' => $team->id,
                    'team_name' => $team->team_name,
                    'competition' => $team->competition->name,
                    'leader_name' => $team->leader->name,
                    'status' => $team->status,
                ];
            })->values();

        $stats = [
            'total_teams' => $teams->count(),
        ];

        return Inertia::render('Juri/Dashboard', [
            'name' => $user->name,
            'role' => 'Juri',
            'teams' => $teams,
            'stats' => $stats,
        ]);
    }
}
