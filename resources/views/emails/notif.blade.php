<div>
    @switch($notification->type)
        @case('new_konseling')
            {{substr($data->konseli->nama_konseli, 0, 3)."**** memulai sesi konseling dengan anda"}}
            @break
        @case('end_konseling')
            @if($user->role == 'konseli')
            {{"Sesi konseling dengan ".$data->konselor->nama_konselor." telah berakhir"}}
            @else
            {{"Sesi konseling dengan ".substr($data->konseli->nama_konseli, 0, 3)."***** telah berakhir"}}
            @endif
            @break
        @case('ask_referral')
            {{$data->konselor->nama_konselor." meminta persetujuan referal"}}
            @break
        @case('agreed_referral')
            {{substr($data->konseli->nama_konseli, 0, 3)."***** menyetujui persetujuan referal"}}
            @break
        @case('new_referral')
            @if($user->role == 'konseli')
            {{"Sesi konseling anda telah berpindah ke konselor baru"}}
            @else
            {{"Anda menerima referral konseling"}}
            @endif
            @break
        @case('declined_referral')
            {{substr($data->konseli->nama_konseli, 0, 3)."***** menolak persetujuan referal"}}
            @break
        @case('ask_conference')
            {{$data->konselor->nama_konselor." meminta persetujuan conference"}}
            @break
        @case('agreed_conference')
            {{substr($data->konseli->nama_konseli, 0, 3)."***** menyetujui persetujuan conference"}}
            @break
        @case('declined_conference')
            {{substr($data->konseli->nama_konseli, 0, 3)."***** menolak persetujuan conference"}}
            @break
        @case('invitation_conference')
            {{$notification->title. " mengundang conference"}}
            @break
        @default
    @endswitch
</div>
<div>
    <br><br>
    <p>
        Silahkan masuk ke
        <a href="{{config('app.url')}}">{{config('app.url')}}</a>
    </p>

</div>
