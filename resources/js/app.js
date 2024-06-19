import './bootstrap';
import 'preline';

document.addEventListener('livewire:navigated', () => { 
    Window.HSStaticMethods.autoInit();
})