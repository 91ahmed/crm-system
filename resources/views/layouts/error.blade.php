@if ($errors->any())
    <div class="pt-4">
        <div class="toast fade show err-msg" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast" style="max-width: 100% !important;">
            <div class="toast-header">
                <!--<img src="assets/images/logo-sm.png" alt="brand-logo" height="14" class="mr-1">-->
                <i class="mdi mdi-block-helper" style="margin-right: 4px;"></i>
                <strong class="mr-auto">ERROR</strong>
                <!--<small>11 mins ago</small>-->
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">
                <ul class="p-0">
                    @foreach ($errors->all() as $error)
                    <li style="list-style: none; margin-bottom: 3px;font-size: 12px;">⇾ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

@if(session()->exists('save'))
    <div class="pt-4">
        <div class="toast fade show err-msg" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast" style="max-width: 100% !important;">
            <div class="toast-header">
                <!--<img src="assets/images/logo-sm.png" alt="brand-logo" height="14" class="mr-1">-->
                <i class="mdi mdi-check-circle" style="margin-right: 4px;"></i>
                <strong class="mr-auto">Done</strong>
                <!--<small>11 mins ago</small>-->
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">
                {{ session()->get('save') }}
            </div>
        </div>
    </div>
@endif

@if(session()->exists('update'))
    <div class="pt-4">
        <div class="toast fade show err-msg" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast" style="max-width: 100% !important;">
            <div class="toast-header">
                <!--<img src="assets/images/logo-sm.png" alt="brand-logo" height="14" class="mr-1">-->
                <i class="mdi mdi-check-circle" style="margin-right: 4px;"></i>
                <strong class="mr-auto">Done</strong>
                <!--<small>11 mins ago</small>-->
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">
                {{ session()->get('update') }}
            </div>
        </div>
    </div>
@endif

@if(session()->exists('delete'))
    <div class="pt-4">
        <div class="toast fade show err-msg" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast" style="max-width: 100% !important;">
            <div class="toast-header">
                <!--<img src="assets/images/logo-sm.png" alt="brand-logo" height="14" class="mr-1">-->
                <i class="mdi mdi-check-circle" style="margin-right: 4px;"></i>
                <strong class="mr-auto">Done</strong>
                <!--<small>11 mins ago</small>-->
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">
                {{ session()->get('delete') }}
            </div>
        </div>
    </div>
@endif