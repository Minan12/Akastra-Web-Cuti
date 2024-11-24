
$('#kecamatan_id').on('change', function(){
    var valueKecamatan = this.value;
    console.log(valueKecamatan)
    $("#kecamatan_id").html('');
    $.ajax({
        url: "{{ url('/api/kecamatan-aktif') }}",
        type: "POST",
        data: {
            dataRegion: valueRegion,
            _token: '{{ csrf_token() }}'
        },
        dataType: 'json',
        success: function(result){
            // console.log(result);
            $('#kecamatan_id').html('<option value="" disabled selected>Pilih Kecamatan</option>');
            $.each(result.kecamatan, function(key, value){
                $("#kecamatan_id").append('<option value="' + value
                    .id + '">' + value.name + '</option>');
            })
        }
    })
});
