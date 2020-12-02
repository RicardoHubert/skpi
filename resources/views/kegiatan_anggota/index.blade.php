@extends('layout.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script defer src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<div class="main">
    <div class="main-control">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            @if($message ?? '')
                                <span class="alert alert-success">{{$message}}</span>
                            @endif
                        </div>
                        <div class="card">
                            <form enctype="multipart/form-data" action="{{route('kegiatan_anggota.post')}}" method="POST" style="padding: 40px;">
                                <div class="card-header"><h3>Tambah Data Angota</h3></div>
                                <div class="card-body">
                                    @csrf

                                    <x-form.wrapper title="Nama Ormawa" required="true">
                                        <select class="form-control" id="exampleFormControlSelect1" name="ormawa_id" required>
                                        <option value="">"------Pilih-------"</option>
                                          @foreach($ormawas as $ormawa)
                                          <option value="{{$ormawa->id}}">{{$ormawa->nama_ormawa}}</option>
                                          @endforeach
                                         </select>
                                    </x-form.wrapper>

                                    <x-form.wrapper title="Nama/Tema Kegiatan" required="true">
                                        <select class="form-control select2" ajax="kegiatan" id="kegiatan_id" name="kegiatan_id" style="width:100%" />
                                        </select>
                                    </x-form.wrapper>


                                    <x-form.wrapper title="Nama Mahasiswa" required="true">
                                        <select class="form-control select2" ajax="kalbiser" id="kalbiser_id" name="kalbiser_id" style="width:100%" />
                                        </select>
                                     </x-form.wrapper>

                                    <x-form.wrapper title="Jenis Dokumen" required="true">
                                        <select class="form-control" name="jenis_dokumen" required>
                                        <option value="">"------Pilih-------"</option>
                                        <option value="SK">SK(Surat Keputusan)</option>
                                        <option value="SERTIFIKAT">Sertifikat</option>
                                        <option value="STU">Surat Tugas</option>
                                        <option value="PIAGAM">Piagam</option>
                                        <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </x-form.wrapper>

                                    <x-form.wrapper title="Penyelenggara" required="true">
                                        <x-form.input name="penyelenggara" required placeholder="penyelenggara" />
                                    </x-form.wrapper>

                                    <x-form.wrapper title="Tanggal Dokumen" required="true">
                                            <input readonly type="text" name="tanggal_dokumen" class="form-control datepicker date" aria-describedby="emailHelp" placeholder="dd/mm/yyyy">
                                    </x-form.wrapper>

                                    <x-form.wrapper title="Tahun Dokumen" required="true">
                                        <input type="number" min="2000" max="{{Carbon\Carbon::now()->isoFormat("YYYY")}}" value="{{Carbon\Carbon::now()->isoFormat("YYYY")}}" name="tahun" class="form-control" aria-describedby="emailHelp" placeholder="Tahun Dokumen" />
                                        Sesuai dengan tanggal dokumen
                                    </x-form.wrapper>
                                </div>
                                <div class="card-footer">
                                    <button name="submit" value="submit" type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#kegiatanAnggota').DataTable();

       $(".datepicker.date").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
        $(".datepicker.year").datepicker({dateFormat: "yy"});

        //UNTUK SELECT 2
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.select2').select2({
            ajax: {
                url: `{{route("ajax.datas")}}`,
                dataType: 'json',
                data: function(params){
                    return {
                        type: this[0].getAttribute("ajax"),
                        q: params.term
                    }
                },
                processResults: function (data) {
                    console.log(this.$element[0].id);
                    if(this.$element[0].id == "kalbiser_id"){
                        return processResults.users(data);
                    }else{
                        return processResults.kegiatans(data);
                    }
                }
            },
            minimumInputLength: 1
        });

        const processResults = {
            users: (data) => {
                return {
                    results: data.map(u => {
                        return {id: u.id, text: u.nama + " - " + u.nim};
                    })
                };
            },
            kegiatans: (data) => {
                return {
                    results: data.map(k => {
                        return {id: k.id, text: k.nama_kegiatan};
                    })
                };
            }
        }
    });
</script>
@endsection

