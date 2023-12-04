

<form
class="d-inline-block"
action="{{ $route }}"    method="POST" onsubmit="return confirm('{{ $message }}')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-danger" ><i class="fa-regular fa-trash-can"></i></button>
</form>
