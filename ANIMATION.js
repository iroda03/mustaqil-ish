document.addEventListener('DOMContentLoaded', function() {
    // Scroll animatsiyalari
    const animateOnScroll = () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        document.querySelectorAll('.product-card').forEach((card) => {
            card.style.opacity = 0;
            card.style.transform = 'translateY(50px)';
            card.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            observer.observe(card);
        });
    }

    // Navbar scroll effekti
    const navScrollEffect = () => {
        const navbar = document.querySelector('.navcha');
        window.addEventListener('scroll', () => {
            window.scrollY > 50 
                ? navbar.style.background = 'rgba(255, 255, 255, 0.9)'
                : navbar.style.background = 'rgba(255, 255, 255, 0.25)';
        });
    }

    // Tugma hover effektlari
    const buttonHover = () => {
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('mouseenter', (e) => {
                e.target.style.transform = 'scale(1.05)';
                e.target.style.background = 'var(--accent)';
            });
            button.addEventListener('mouseleave', (e) => {
                e.target.style.transform = 'scale(1)';
                e.target.style.background = 'var(--primary)';
            });
        });
    }

    // Logo animatsiyasi
    const logoAnimation = () => {
        const logo = document.querySelector('.logo');
        logo.style.transform = 'scale(0)';
        setTimeout(() => {
            logo.style.transition = 'all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
            logo.style.transform = 'scale(1)';
        }, 300);
    }

    // Funktsiyalarni ishga tushirish
    animateOnScroll();
    navScrollEffect();
    buttonHover();
    logoAnimation();

    // Qo'shimcha effekt: Input fokus animatsiyasi
    document.querySelector('.search-input').addEventListener('focus', (e) => {
        e.target.parentElement.style.transform = 'scale(1.02)';
    });
    document.querySelector('.search-input').addEventListener('blur', (e) => {
        e.target.parentElement.style.transform = 'scale(1)';
    });
});