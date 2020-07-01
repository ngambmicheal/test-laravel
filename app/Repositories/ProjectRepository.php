<?php

namespace App\Repositories;
use App\Model\Project;


class ProjectRepository 
{
    //
    /**
     * Get list of Projects
     * @param $type json || html 
     * @return string or json
     */
    public function getProjects($type='json'){
        $projects = Project::all();
        if($type=='html'){
            $response = ''; 
            foreach($projects as $project) $response.="<option value='{$project->id}'>{$project->name}</option>";

            return $response;
        }
        else return $projects; 
    }
}
