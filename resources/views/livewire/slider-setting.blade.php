<div class="bs-stepper horizontal-wizard-example linear">
    <div class="bs-stepper-header" role="tablist">
        <div class="step {{ $step == 1 ? 'active' : '' }}">
            <button type="button" class="step-trigger" {{ $step > 1 ? 'disabled' : '' }}>
                <span class="bs-stepper-box">1</span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title">إنشاء المعرض</span>
                    <span class="bs-stepper-subtitle">إعدادات المعرض</span>
                </span>
            </button>
        </div>
        <div class="line">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
        
        <div class="step {{ $step == 2 ? 'active' : '' }}">
            <button type="button" class="step-trigger" {{ $step < 2 ? 'disabled' : '' }}>
                <span class="bs-stepper-box">2</span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title">إضافة الشرائح</span>
                    <span class="bs-stepper-subtitle">إضافة شريحة</span>
                </span>
            </button>
        </div>
    </div>
    <div class="bs-stepper-content">

        <!-- الخطوة 1: ضبط الإعدادات -->
        <div id="survey-details" class="content {{ $step == 1 ? 'active' : ''}}">
            <div class="content-header">
                <h5 class="mb-0">بيانات المعرض</h5>
                <small class="text-muted">ضبط الإعدادات</small>
            </div>
            <div class="mb-1">
                <label class="form-label" for="name">اسم المعرض</label>
                <input type="text" wire:model="name" id="name" class="form-control" placeholder="اسم المعرض ...">
                @error('name') <div class="alert alert-danger mt-1"><div class="alert-body">{{ $message }}</div></div> @enderror
            </div>
            <div class="mb-1">
                <label class="form-label">عدد العناصر في الشريحة</label>
                <input type="number" wire:model="items_number" id="items_number" class="form-control" placeholder="عدد العناصر ...">
                @error('items_number') <div class="alert alert-danger mt-1"><div class="alert-body">{{ $message }}</div></div> @enderror
            </div>
        </div>

        <!-- الخطوة 2: إضافة شرائح السلايدر -->
        <div id="slider-container" class="content {{ $step == 2 ? 'active' : ''}}">
            <div class="content-header">
                <h5 class="mb-0">شرائح السلايدر</h5>
                <small>أضف شريحة</small>
            </div>
            <form wire:submit.prevent="UpdateSlice" enctype="multipart/form-data">
                <!-- form add slices -->
                <div class="mt-2 mb-2">
                    @if($code === 'Hero1')
                        <!-- نص فقط -->
                        <div class="mt-1 mb-1">
                            <label class="form-label">العنوان</label>
                            <input type="text" wire:model="title" class="form-control" placeholder="ادخل عنوان ...">
                            @error('title') <div class="alert alert-danger mt-1"><div class="alert-body">{{ $message }}</div></div> @enderror
                        </div>
                        <div class="mt-1 mb-1">
                            <label class="form-label">الوصف</label>
                            <textarea wire:model="description" class="form-control" rows="5" placeholder="ادخل وصف ..."></textarea>
                            @error('description') <div class="alert alert-danger mt-1"><div class="alert-body">{{ $message }}</div></div> @enderror
                        </div>
                        <div id="hero-sliderText-container">
                            <div class="owl-carousel owl-hero-thumb owl-theme owl-rtl owl-loaded" id="hero-sliderText"></div>
                        </div>
                        <div class="mt-1 mb-1">
                            <label class="form-label">الرابط إن وجد (اختيارى)</label>
                            <input type="text" wire:model="refLink" class="form-control" placeholder="ادخل الرابط الذى تريد المستخدم الذهاب إليه عند الضغط علي الشريحة ...">
                        </div>
                    @elseif($code === 'Hero2' || $code === 'Hero3')
                        <!-- صورة فقط -->
                        <div class="mt-1 mb-1">
                            <label class="form-label">الصورة</label>
                            <input type="file" wire:model="image" class="form-control">
                            @error('image') <div class="alert alert-danger mt-1"><div class="alert-body">{{ $message }}</div></div> @enderror
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail mt-2" width="150">
                            @endif
                        </div>
                        <div class="mt-1 mb-1">
                            <label class="form-label">الرابط إن وجد (اختيارى)</label>
                            <input type="text" wire:model="refLink" class="form-control" placeholder="ادخل الرابط الذى تريد المستخدم الذهاب إليه عند الضغط علي الشريحة ...">
                        </div>
                    @elseif($code === 'University')
                        <!-- فيديو يوتيوب -->
                        <div class="mt-1 mb-1">
                            <label class="form-label">رابط فيديو يوتيوب</label>
                            <input type="url" wire:model="youtube_link" class="form-control" placeholder="https://www.youtube.com/watch?v=xxxx">
                            @error('youtube_link') <div class="alert alert-danger mt-1"><div class="alert-body">{{ $message }}</div></div> @enderror
                        </div>
                        <div class="mt-1 mb-1">
                            <label class="form-label">الرابط إن وجد (اختيارى)</label>
                            <input type="text" wire:model="refLink" class="form-control" placeholder="ادخل الرابط الذى تريد المستخدم الذهاب إليه عند الضغط علي الشريحة ...">
                        </div>
                    @else
                        <!-- صورة + نص -->
                        <div class="mt-1 mb-1">
                            <label class="form-label">العنوان</label>
                            <input type="text" wire:model="title" class="form-control" placeholder="ادخل عنوان ...">
                            @error('title') <div class="alert alert-danger mt-1"><div class="alert-body">{{ $message }}</div></div> @enderror
                        </div>
                        <div class="mt-1 mb-1">
                            <label class="form-label">الوصف</label>
                            <textarea wire:model="description" class="form-control" rows="5" placeholder="ادخل وصف ..."></textarea>
                            @error('description') <div class="alert alert-danger mt-1"><div class="alert-body">{{ $message }}</div></div> @enderror
                        </div>
                        <div class="mt-1 mb-1">
                            <label class="form-label">الصورة</label>
                            <input type="file" wire:model="image" class="form-control">
                            @error('image') <div class="alert alert-danger mt-1"><div class="alert-body">{{ $message }}</div></div> @enderror
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail mt-2" width="150">
                            @endif
                        </div>
                        <div class="mt-1 mb-1">
                            <label class="form-label">الرابط إن وجد (اختيارى)</label>
                            <input type="text" wire:model="refLink" class="form-control" placeholder="ادخل الرابط الذى تريد المستخدم الذهاب إليه عند الضغط علي الشريحة ...">
                        </div>
                    @endif
    
                    <hr/>
                    <!-- slider preview table -->
                    @if($code == 'Hero1')
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>العنوان</th>
                                    <th>الوصف</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slices as $index => $slice)
                                    <tr>
                                        <td>{{ $slice['title'] ?? '-' }}</td>
                                        <td>{{ $slice['description'] ?? '-' }}</td>
                                        <td>
                                            <button wire:click="removeSlice({{ $loop->index }})" class="btn btn-icon btn-danger waves-effect waves-float waves-light">
                                                <i class='fa fa-trash'></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>       
                    @else 
                        <div wire:loading wire:target="image" class="alert alert-info">
                            جارٍ تحميل الصورة، يرجى الانتظار...
                        </div>
                        <table wire:on="refreshSlices" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>الصورة / الفيديو</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slices as $index => $slice)
                                    <tr>    
                                        <td>
                                            @if($code == 'University')
                                                <iframe width="150" height="100" src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::after($slice['youtube_link'], 'v=') }}" frameborder="0" allowfullscreen></iframe>
                                            @else 
                                                <img src="{{ asset($slice['image']) }}" alt="صورة" style="width: 100px; height: auto;">
                                            @endif
                                        </td>
                                        <td>
                                            <button wire:click="removeSlice({{ $loop->index }})" class="btn btn-icon btn-danger waves-effect waves-float waves-light">
                                                <i class='fa fa-trash'></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
        
                    <button type="submit"  wire:loading.attr="disabled" wire:target="UpdateSlice" class="btn btn-success btn-next waves-effect waves-float waves-light">
                        <span class="align-middle">أضف شريحة</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-between">
            @if($step == 1)
                <button class="btn btn-primary btn-prev waves-effect waves-float waves-light" wire:click="PreviousStep" {{ $step == 1 ? 'disabled' : '' }}>
                    <span class="align-middle">السابق</span>
                </button>
                <button class="btn btn-primary btn-next waves-effect waves-float waves-light" wire:click="NextStep">
                    <span class="align-middle">التالي</span>
                </button>
            @elseif($step > 1)
                <button class="btn btn-primary btn-prev waves-effect waves-float waves-light" wire:click="PreviousStep" {{ $step == 1 ? 'disabled' : '' }}>
                    <span class="align-middle">السابق</span>
                </button>
                <button class="btn btn-primary btn-next waves-effect waves-float waves-light  @if(count($slices) === 0) disabled @endif" @if(count($slices) === 0) disabled @endif wire:loading.attr="disabled"  wire:target="saveSlider" wire:click="saveSlider">
                    <span class="align-middle">حفظ المعرض</span>
                </button>
            @endif
        </div>
    </div>
</div>