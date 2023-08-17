<div>
    @if (auth()->user()->current_project_id)
        <x-custom.card.picture :upload-picture="$uploadPicture" :upload="$project->id"/>
    @endif
</div>
