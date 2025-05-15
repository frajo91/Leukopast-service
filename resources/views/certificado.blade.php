<!--<link rel="stylesheet" href="{{ public_path('css/certificado.css') }}">-->
<style type="text/css">
    @font-face {
    font-family: 'HelveticaNeue';
    font-style: normal;
    font-weight: normal;
    src: url("{{ public_path('css/HelveticaNeueLTStd-Lt.otf') }}") format('truetype');
}

    @font-face {
    font-family: 'Neo Sans bold';
    font-style: normal;
    font-weight: bold;
    src: url("{{ public_path('css/neo-sans-std-medium.otf') }}") format('truetype');
}

    @font-face {
    font-family: 'HelveticaNeueLTStd-Md';
    font-style: normal;
    font-weight: normal;
    src: url("{{ public_path('css/HelveticaNeueLTStd-Md.otf') }}") format('truetype');
}

    @font-face {
    font-family: 'HelveticaNeue roman';
    font-style: normal;
    font-weight: normal;
    src: url("{{ public_path('css/HelveticaNeueLTStd-Roman.otf') }}") format('truetype');
}

}

    html{
          font-family:'HelveticaNeue' !important ;
        }

    @page{
        margin: 0px;
    }
    table tr td {
        padding: 0px;
        margin: 0px;
    }


    .image{
        background-image:url("{{ public_path  ('imgCertificado1.jpg') }}") ;
        background-size:cover;
        background-repeat: no-repeat;
        box-shadow: 10px 5px 5px black;
    }
</style>

<table style="width: 100%; height: 99%; padding: 0px;">
    <tr >
        <td  style="width: 25%; padding: 0px; height: 99%;" class="image">
            <!--<img style="width:auto; height:stretch; padding: 0px; margin: 0px" src="{{ public_path('image.png') }}">-->
            <!--<img src="{{ public_path('image.png') }}"> -->
        </td>
        <td >
            <table style="height: 98%;">
                <tr>
                    <td style="border-bottom: 2px solid red; height: 7cm;">
                        <center>
                            <img src="{{ public_path('logo.png') }}" style="max-height:3cm;">
                            <!--<img src="{{ public_path('logo.png') }}"> -->
                        </center>

                    </td>
                </tr>
                <tr>
                    <td style="height:3cm;">
                        <center>
                            <h1 style="font-weight: lighter; font-size:60px; font-family:'HelveticaNeue roman'  ">{{__('messages.certificado_certifica'}}</h1>
                        </center>

                    </td>
                </tr>
               <tr>
                    <td style="height: 4cm;">
                        <center>
                            <h1 style="font-weight: lighter; font-size: 80px; text-transform: uppercase;line-height: 60px; font-family:'HelveticaNeueLTStd-Md' !important ;margin-top: 16px;">{{$usuario}}</h1>
                        </center>

                    </td>
                </tr>
               <tr>
                    <td style="height:4cm">
                        <center>
                            <h2 style="font-weight: lighter; font-size:40px; font-family:'HelveticaNeue' !important ;">{{__('messages.certificado_finalizo')}}</h2>
                            <h1 style="font-weight: lighter; line-height: 16px;font-family:'HelveticaNeueLTStd-Md' !important ; font-size:40px;">{{env('APP_NAME')}}</h1>
                        </center>

                    </td>
                </tr>
                <tr>
                    <td style="height:auto;">
                        <center>
                            <p style="font-weight: normal; padding-right: 80px;  padding-left: 80px; font-size: 18px;">{{__('messages.certificado_mensaje')}}</p>
                        </center>

                    </td>
                </tr>
                <tr>
                    <td style="height: auto;">

                    </td>
                </tr>
            </table>
        </td>
    </tr>


</table>
<img style="width:100%; position: fixed; bottom: 50px;" src="{{ public_path('linea.png') }}">
