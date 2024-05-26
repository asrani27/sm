
@if (Session::get('success'))
  iziToast.success({
    title: 'Success',
    message: '{{Session::get('success')}}',
    position: 'center',
  });
@endif

@if (Session::get('warning'))
  iziToast.warning({
    title: 'Warning',
    message: '{{Session::get('warning')}}',
    position: 'center',
  });
@endif

@if (Session::get('info'))
  iziToast.info({
    title: 'Info',
    message: '{{Session::get('info')}}',
    position: 'center',
  });
@endif

{{-- @if ($errors->any())
    @foreach ($errors->all() as $error)
    iziToast.error({
      title: 'Error',
      message: '{{$error}}',
      position: 'center',
    });
    @endforeach
@endif --}}

@if (Session::get('error'))
  iziToast.error({
    title: 'Error',
    message: '{{Session::get('error')}}',
    position: 'center',
  });
@endif