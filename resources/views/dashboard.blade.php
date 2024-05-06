<x-app-layout>
<x-header title="My Cars" />



<x-car-list :cars="$user->cars" /> <!-- Include the car list component and pass the user's cars as a prop -->
<x-add-car/>
<x-transactions-list :user="$user"/>


</x-app-layout>
