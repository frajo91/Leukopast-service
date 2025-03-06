<!--<link rel="stylesheet" href="{{ asset('css/certificado.css') }}">-->
<style type="text/css">
    @font-face {
    font-family: 'Neo Sans Pro';
    font-style: normal;
    font-weight: normal;
    src: url("{{ public_path('css/Neo Sans Std Regular.otf') }}") format('truetype');
}

    @font-face {
    font-family: 'Neo Sans bold';
    font-style: normal;
    font-weight: bold;
    src: url("{{ public_path('css/neo-sans-std-medium.otf') }}") format('truetype');
}

    @font-face {
    font-family: 'Neo Sans light';
    font-style: normal;
    font-weight: lighter;
    src: url("{{ public_path('css/Neo Sans Std Bold_0.otf') }}") format('truetype');
}

    html{
          font-family:'Neo Sans light' !important ;
          color: #50707aff;
        }

    @page{
        margin: 0px;
    }
    table tr td {
        padding: 0px;
        margin: 0px;
    }


    .image{
        background-image:url("{{ public_path('image.jpg') }}") ;
        background-size: cover;
        background-repeat: no-repeat;
        box-shadow: 10px 5px 5px black;
    }
</style>

<table style="width: 100%; height: 99%; padding: 0px;">
    <tr >
        <td  style="width: 25%; padding: 0px; height: 99%;" class="image">
            <!--<img style="width:auto; height:stretch; padding: 0px; margin: 0px" src="{{ public_path('image.png') }}">-->
            <!--<img src="{{ asset('image.png') }}"> -->
        </td>
        <td >
            <table style="height: 98%;">
                <tr>
                    <td style="border-bottom: 2px solid red; height: 7cm;">
                        <center>
                            <img src="{{ public_path('logo.png') }}" style="height:3cm;">
                            <!--<img src="{{ asset('logo.png') }}"> -->
                        </center>

                    </td>
                </tr>
                <tr>
                    <td style="height:3cm;">
                        <center>
                            <h1 style="font-weight: lighter; font-size:60px; ">Certifica que:</h1>
                        </center>

                    </td>
                </tr>
               <tr>
                    <td style="height: 4cm;">
                        <center>
                            <h1 style="font-size: 80px; text-transform: uppercase;line-height: 60px; font-family:'Neo Sans bold' !important ;margin-top: 16px;">{{$usuario}}</h1>
                        </center>

                    </td>
                </tr>
               <tr>
                    <td style="height:4cm">
                        <center>
                            <h2 style="font-weight: lighter; font-size:40px;">Finalizó exitosamente el e-learning</h2>
                            <h2 style="font-weight: normal; line-height: 16px; font-family:'Neo Sans Pro' !important; font-size:40px;">Educación sobre el cuidado de heridas en las farmacias</h2>
                        </center>

                    </td>
                </tr>
                <tr>
                    <td style="height:auto;">
                        <center>
                            <p style="font-weight: normal;font-family:'Neo Sans Pro' !important; padding-right: 80px;  padding-left: 80px; font-size: 18px;">Este logro demuestra su compromiso y la dedicación en el desarrollo de sus conocimientos y habilidades en el manejo adecuado de heridas en un entorno de cuidado en casa, mejorando así su capacidad para ofrecer una atención de calidad a sus clientes.</p>
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
