<!-- resources/views/includes/success_message.blade.php -->
@if(session('success'))
    <div id="successAlert" class="absolute top-4 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-300 text-green-800 px-6 py-3 rounded shadow-md flex items-center justify-between gap-4 z-50 w-[90%] max-w-xl">
        <span>{{ session('success') }}</span>
        <button onclick="document.getElementById('successAlert').style.display='none'" class="text-green-800 font-bold text-lg leading-none">&times;</button>
    </div>
    <script>
      setTimeout(() => {
        const alertBox = document.getElementById('successAlert');
        if(alertBox) alertBox.style.display = 'none';
      }, 5000);
    </script>
@endif