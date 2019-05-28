@foreach($permissionGroupList as $key => $value)
    <div class="card">
        <div class="card-header border bottom">
            <h4 class="card-title">{{ $value }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($commonPermission[$key] as $permission)
                    <div class="col-md-4">
                        <div class="m-t-15">
                            <div class="form-group">
                                <div class="switch switch-info d-inline m-r-10">
                                    <input class="permission-checkbox" type="checkbox"
                                           id="switch-{{ $permission->id }}" disabled="">
                                    <label for="switch-{{ $permission->id }}"></label>
                                </div>
                                <label>{{ $permission->content }}</label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endforeach
