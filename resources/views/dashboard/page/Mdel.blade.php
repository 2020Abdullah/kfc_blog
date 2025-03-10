<!-- delete model -->
<div class="modal fade text-start modal-danger" id="DelModel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel160">تنبيه !</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('page.delete') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="id" name="id">
                    <p>هل تريد بالفعل حذف هذه الصفحة ؟</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger waves-effect waves-float waves-light">تأكيد</button>
                </div>
            </form>
        </div>
    </div>
</div>