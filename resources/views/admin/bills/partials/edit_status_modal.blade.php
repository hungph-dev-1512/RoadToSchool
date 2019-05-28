<div class="modal fade" id="edit-status-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-label">{{ __('titles.edit_bill_status') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open() }}
                <div class="form-group">
                    {{--{{ Form::label('change_status', __('messages.change_bill_status'), ['class' => 'control-label']) }}--}}
                    {{--                    {{ Form::select('change_status', \App\Models\Bill::$status, null, ['class' => 'form-control', 'id' => 'm-grade']) }}--}}
                    <div class="form-group">
                        <label for="change_status">{{ __('messages.change_bill_status') }}:</label>
                        <select class="form-control" id="change-status-select">
                            @foreach(\App\Models\Bill::$status as $key => $value)
                                <option value="{{ $key }}"> {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <p style="color: red" id="error-m-grade" hidden=""></p>
                </div>
            </div>
            <div class="modal-footer">
                {{ Form::button(__('titles.cancel'), ['class' => 'btn btn-gradient-warning', 'data-dismiss' => 'modal']) }}
                {{ Form::submit(__('titles.change_status'), ['class' => 'btn btn-gradient-success', 'id' => 'update-status']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
