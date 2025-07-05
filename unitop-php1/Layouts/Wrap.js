document.addEventListener('DOMContentLoaded', function() {
    const h1TextElement = document.getElementById('typing-text-h1');
    const pTextElement = document.getElementById('typing-text-p');
    
    if (!h1TextElement || !pTextElement) {
        console.error("Lỗi: Không tìm thấy các phần tử HTML cần thiết cho hiệu ứng gõ chữ. Kiểm tra lại ID trong Wrap.php.");
        return; 
    }

    const textsToType = [
        { element: h1TextElement, text: "CAR WRAPPING", speed: 100, delayAfter: 500, clearBeforeTyping: true },
        { element: pTextElement, text: "DÁN XE", speed: 80, delayAfter: 500, clearBeforeTyping: true }
    ];

    let currentTextIndex = 0;
    let charIndex = 0;

    function typeWriterSequence() {
        if (currentTextIndex < textsToType.length) {
            const currentItem = textsToType[currentTextIndex];
            
            
            if (charIndex === 0 && currentItem.clearBeforeTyping) {
                currentItem.element.textContent = "";
            }

            if (charIndex < currentItem.text.length) {
                currentItem.element.textContent += currentItem.text.charAt(charIndex);
                charIndex++;
                setTimeout(typeWriterSequence, currentItem.speed);
            } else {

                currentTextIndex++;
                charIndex = 0;
                
                if (currentTextIndex < textsToType.length) {
                    setTimeout(typeWriterSequence, currentItem.delayAfter);
                } else {
                    setTimeout(() => {
                        currentTextIndex = 0; 
                        charIndex = 0;      
                        typeWriterSequence();
                    }, textsToType[textsToType.length - 1].delayAfter || 500);
                }
            }
        }
    }

    typeWriterSequence();
});