
<tr id="tr_{{$user->id}}">
    <td>{{$user->name}}</td>
    <td>{{$user->email}}</td>
    <td>
      @foreach($user->roles as $role)
      {{$role->name}},
      @endforeach
    </td>
    <td>{{$user->usuacreacion}}</td>
    <td>{{$user->created_at}}</td>
    <td class="text-right py-0 align-middle">
      <div class="btn-group btn-group-sm">
        <button class="btn btn-primary" onclick="editUser({{$user}})" type="button"><i class="fas fa-edit"></i></button>
        <button class="btn btn-info" onclick="showUser({{$user}})" type="button"><i class="fas fa-eye"></i></button>
        <button class="btn btn-danger" onclick="deleteUser({{$user->id}},'tr_{{$user->id}}')" type="button"><i class="fas fa-trash"></i></button>

      </div>
    </td>
  </tr>
