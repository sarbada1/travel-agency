<?php


namespace App\Http\Controllers\Backend\Team;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Team\TeamCreateRequest;
use App\Repositories\Team\TeamInterface;
use Illuminate\Http\Request;

class TeamController extends BackendController
{
    private $tmInterface;

    public function __construct(TeamInterface $tmInterface)
    {
        parent::__construct();
        $this->tmInterface = $tmInterface;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'teams_list');
        $this->data('teamData', $this->tmInterface->all());
        return view($this->pagePath . 'team.index', $this->data);
    }


    public function create()
    {
        $this->data('membersTypeData', $this->tmInterface->getMemberType());
        return view($this->pagePath . 'team.create', $this->data);
    }


    public function store(TeamCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'teams_create');
        $this->tmInterface->insert($request->all());
        return redirect()->back()->with('success', 'Team created successfully');
    }


    public function show(string $id)
    {
        return redirect()->back();
    }

    public function edit(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'teams_edit');
        $this->data('membersTypeData', $this->tmInterface->getMemberType());
        $this->data('teamData', $this->tmInterface->find($id));
        return view($this->pagePath . 'team.update', $this->data);
    }

    public function update(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'teams_edit');
        $request->validate([
            'member_type_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:teams,email,' . $id,

        ]);
        $this->tmInterface->update($request->all(), $id);
        return redirect()->back()->with('success', 'Team updated successfully');
    }

    public function destroy(Request $request, string $id)
    {
        $this->checkAuthorization($request->user(), 'teams_delete');
        $this->tmInterface->delete($id);
        return redirect()->back()->with('success', 'Team deleted successfully');
    }
}
