<!DOCTYPE html>

<head>
    <title>Pusher Test</title>
</head>

<body>
    <h1>Pusher Test</h1>
    <p>
        Try publishing an event to channel <code>sample-channel</code>
        with event name <code>terima</code>.
    </p>

    <form id="form">
        <input type="text" id="isi_pesan" />
        <button type="submit" id="btn_submit">
            Kirim
        </button>
    </form>
    </form>

    <div id="pesan"></div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        let form = document.getElementById('form')
        let isi_pesan = document.getElementById('isi_pesan')
        let btn_submit = document.getElementById('btn_submit')
        let pesan = document.getElementById('pesan')

        form.addEventListener('submit', e => {
            e.preventDefault();

            $.ajax({
                url: `{{ url('kirim') }}`,
                method: 'get',
                dataType: 'json',
                data: {
                    message: isi_pesan.value
                }
            }).fail(e => {
                console.log(e.responseText)
            }).done(e => {
                console.log(e)
            })

        })


        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('5fc18dbeabdcaf82eb25', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('sample-channel');
        channel.bind('terima', function(data) {
            // alert(JSON.stringify(data));
            console.log(JSON.stringify(data))

            pesan.innerHTML += `${data.message}<br />`
        });
    </script>
</body>
