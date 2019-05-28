<div class="modal fade" id="create-categories-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-label">{{ __('titles.create_new_category') }}</h4>
                <button type="button" id="create-close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            {{ Form::open(['route' => 'admin.categories.store', 'method' => 'post']) }}

            @foreach ($errors->all() as $error)
                <div class="alert alert-danger fix-alert">{{ $error }}</div>
            @endforeach
            <div class="modal-body mx-3">
                <div class="row">
                    <div class="form-group col-md-6">
                        {{ Form::label('title', __('titles.category_title')) }}
                        {{ Form::text('title', null, ['class' => 'form-control validate', 'id' => 'title']) }}
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('parent_id', __('titles.parent_category'), ['class' => 'control-label']) !!}
                        {!! Form::select('parent_id', $parentCategories, 0, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="text-sm-right">
                    {{ Form::submit(__('add new'), ['class' => 'btn btn-primary', 'id' => 'create-btn']) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
