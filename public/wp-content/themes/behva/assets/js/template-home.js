document.addEventListener('DOMContentLoaded', function () {

  const tab_splide = document.querySelector('.tab-splide');
  const paginationWrapper = document.querySelector('.custom-pagination'); // <<< เปลี่ยนตรงนี้

  if (tab_splide && paginationWrapper) {

    const splide_tab_splide = new Splide('.tab-splide', {
      type: 'slide',
      perPage: 1,
      perMove: 1,          // บังคับให้เลื่อนทีละ 1 เสมอ
      wheel: true,
      wheelMinThreshold: 15, // ตัด scroll เบา ๆ ทิ้ง ลดการเด้งซ้อน
      wheelSleep: 1000,      // หน่วง 2 วิ ก่อนรับ wheel ครั้งต่อไป
      waitForTransition: true, // ไม่ให้รับ action ใหม่ระหว่างกำลังเลื่อน
      height: '60vh',
      speed: 1000,           // ลดจาก 1800 ให้รู้สึกไม่หนืดเกินไป
      pagination: false,
      arrows: false,
      fixedWidth: '95%',     // ถ้าคุณยังอยากเห็น slide ถัดไป
      gap: '24px',
      focus: 'left',
      trimSpace: false,
    });

    splide_tab_splide.on('mounted move', function () {
      const slides = tab_splide.querySelectorAll('.splide__slide');

      paginationWrapper.innerHTML = '';

      slides.forEach(function (slide, index) {
        const title = slide.getAttribute('data-title') || `Slide ${index + 1}`;
        const color = slide.getAttribute('data-color');

        const btn = document.createElement('button');
        btn.className = 'custom-page-btn';
        btn.textContent = title;

        if (index === splide_tab_splide.index) {
          btn.classList.add('is-active');
          if (color) {
            btn.style.backgroundColor = color;
          }
        }

        btn.addEventListener('click', function () {
          document.querySelectorAll('.custom-page-btn').forEach(function(button) {
            button.style.backgroundColor = '';
          });
          splide_tab_splide.go(index);
          if (color) {
            btn.style.backgroundColor = color;
          }
        });

        paginationWrapper.appendChild(btn);
      });
    });

    splide_tab_splide.mount();
  }
});