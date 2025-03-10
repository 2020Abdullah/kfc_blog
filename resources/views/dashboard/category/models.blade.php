<!-- create model -->
<div class="modal fade text-start modal-primary" id="createModel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">قسم جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('category.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-1">
                        <label class="form-label">اسم القسم</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success waves-effect waves-float waves-light">حفظ البيانات</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- update model -->
<div class="modal fade text-start modal-primary" id="UpdateModel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">تعديل القسم</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('category.update') }}">
                @csrf
                <input type="hidden" class="id" name="cate_id">
                <div class="modal-body">
                    <div class="mb-1">
                        <label class="form-label">اسم القسم</label>
                        <input type="text" class="form-control name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success waves-effect waves-float waves-light">حفظ البيانات</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- delete model -->
<div class="modal fade text-start modal-danger" id="DelModel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">تنبيه !</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('category.del') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="cate_id" name="cate_id">
                    <p>هل تريد بالفعل حذف هذا القسم ؟</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger waves-effect waves-float waves-light">تأكيد</button>
                </div>
            </form>
        </div>
    </div>
</div>