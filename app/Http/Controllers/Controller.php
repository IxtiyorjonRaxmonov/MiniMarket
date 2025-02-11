<?php

namespace App\Http\Controllers;

use App\Models\UserRule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use function Laravel\Prompts\select;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function check($action, $module)
    {
        $userId = auth()->user()->id;
        return UserRule::where('user_rules.user_id', $userId)
            ->join('rules', 'rules.id', 'user_rules.rule_id')
            ->join('modules', 'modules.id', 'rules.module_id')
            ->join('actions', 'actions.id', 'rules.action_id')
            ->where('modules.module', $module)
            ->where('actions.action', $action)
            ->where('rules.active', true)
            ->where('user_rules.active', true)
            ->first();
    }
}
