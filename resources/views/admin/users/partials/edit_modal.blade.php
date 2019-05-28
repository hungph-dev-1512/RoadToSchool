<div class="modal fade" id="edit-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-label">{{ __('titles.edit_user_infomation') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open() }}
                <div class="form-group">
                    {{ Form::label('email', __('titles.email'), ['class' => 'control-label']) }}
                    {{ Form::text('email', null, ['class' => 'form-control', 'id' => 'm-email', 'disabled' => '']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('name', __('titles.name'), ['class' => 'control-label']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'm-name']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('phone', __('titles.phone_number'), ['class' => 'control-label']) }}
                    {{ Form::text('phone', null, ['class' => 'form-control', 'id' => 'm-phone']) }}
                    <p style="color: red" id="error-m-phone" hidden=""></p>
                </div>
                <div class="form-group">
                    {{ Form::label('birthday', __('titles.date_of_birth'), ['class' => 'control-label']) }}
                    {{ Form::text('birthday', null, ['class' => 'form-control', 'id' => 'm-birthday', 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd']) }}
                    <p style="color: red" id="error-m-birthday" hidden=""></p>
                </div>
                <div class="form-group">
                    {{ Form::label('address', __('titles.address'), ['class' => 'control-label']) }}
                    {{ Form::text('address', null, ['class' => 'form-control', 'id' => 'm-address']) }}
                    <p style="color: red" id="error-m-address" hidden=""></p>
                </div>
                <div class="form-group">
                    {{ Form::label('personal_info', __('titles.personal_info'), ['class' => 'control-label']) }}
                    {{ Form::textarea('personal_info', null, ['class' => 'form-control', 'id' => 'm-personal-info', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) }}
                    <p style="color: red" id="error-m-personal-info" hidden=""></p>
                </div>
                <div class="form-group">
                    {{ Form::label('working_place', __('titles.working_place'), ['class' => 'control-label']) }}
                    {{ Form::textarea('working_place', null, ['class' => 'form-control', 'id' => 'm-working-place', 'rows' => 2, 'cols' => 54, 'style' => 'resize:none']) }}
                    <p style="color: red" id="error-m-working-place" hidden=""></p>
                </div>
                <div class="form-group">
                    {{ Form::label('grade', __('titles.grade'), ['class' => 'control-label']) }}
                    {{ Form::select('grade', \App\Models\User::$grades, null, ['class' => 'form-control', 'id' => 'm-grade']) }}
                    <p style="color: red" id="error-m-grade" hidden=""></p>
                </div>
                <div class="form-group">
                    {{ Form::label('role', __('titles.role'), ['class' => 'control-label']) }}
                    {{ Form::select('role', \App\Models\User::$roles, null, ['class' => 'form-control', 'id' => 'm-role']) }}
                    <p style="color: red" id="error-m-role" hidden=""></p>
                </div>
                {{ Form::close() }}</div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="submit" id="update-user-info" data-id="{{ $user->id }}">
                    {{ __('titles.update_user_infomation') }}
                </button>
                <button class="btn btn-warning" type="button" data-dismiss="modal">
                    {{ __('titles.close') }}
                </button>
            </div>
        </div>
    </div>
</div>