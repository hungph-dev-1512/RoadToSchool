<div class="modal fade" id="delete-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-label">{{ __('titles.confirm') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">{{ __('messages.are_you_sure') }}</div>
            <div class="modal-footer">
                {{ Form::open(['method' => 'delete', 'id' => 'form-delete']) }}
                {{ csrf_field() }}
                {{ Form::button(__('titles.cancel'), ['class' => 'btn btn-gradient-warning', 'data-dismiss' => 'modal']) }}
                {{ Form::submit(__('titles.confirm'), ['class' => 'btn btn-gradient-success', 'id' => 'del-btn']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
