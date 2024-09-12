<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
</head>

<body>

    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    
    <p><a class="btn btn-success" href='{{ route("projects.create") }}'><i class="fa fa-plus"></i> Create Project</a></p>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    Title
                </th>
                <th>
                    Created
                </th>
                <th width="5%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr>
                <td>
                    {{ $project->title ?? 'N/A' }}
                </td>

                <td>
                    {{ optional($project->created_at)->diffForHumans() }}
                </td>

                <td>
                    <a class="btn btn-success d-block mb-2" href='{{ route("projects.edit", $project->id) }}'><i class="fa fa-pencil"></i> Edit</a>
                    
                    <form method="POST" action="{{ route('projects.destroy', $project->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <div class="form-group">
                            <i class="fa fa-times"></i>
                            <input type="submit" class="btn btn-danger d-block" value="Delete">
                        </div>
                    </form>
                    
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" align="center">No records found!</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>