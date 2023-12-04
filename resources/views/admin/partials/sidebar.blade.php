

<aside class="bg-dark">
    <nav>
        <ul>
            <li><a href="{{ route('admin.home')}}"><i class="fa-solid fa-house me-2"></i> Dashboard</a></li>

            <li><a href="{{ route('admin.projects.index')}}"><i class="fa-solid fa-list me-2"></i> Project List</a></li>

            <li><a href="{{ route('admin.projects.create')}}" class="text-success"><i class="fa-solid fa-folder-plus text-white"></i>  New project</a></li>

            <li><a href="{{ route('admin.technologies.index')}}"><i class="fa-solid fa-code"></i>   Technologies</a></li>
            <li><a href="{{ route('admin.types.index')}}"><i class="fa-solid fa-layer-group me-2"></i> Types</a></li>
            <li><a href="{{ route('admin.type-projects')}}"><i class="fa-solid fa-code-merge"></i> Projects for type</a></li>
        </ul>
    </nav>
</aside>
