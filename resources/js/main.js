let navBarCus=document.querySelector('.navbarCus');
let navLink=document.querySelectorAll('.nav-link');
let navLogo=document.querySelector('.fa-cart-shopping');
let dropdown=document.querySelector('#dropdownAccess');
let dropdownCat=document.querySelector('#dropdownScroll');


console.log(dropdown);
window.addEventListener('scroll',()=>{
  if (window.scrollY > 0) {
    navBarCus.classList.add('navScroll')
    navBarCus.classList.remove('navFixed')
    dropdown.classList.add('navScroll');
    dropdown.classList.remove('navFixed');
    dropdownCat.classList.add('navScroll');
    dropdownCat.classList.remove('navFixed');
       navLink.forEach(navLink => {
    navLink.classList.remove('txt-main');
    navLink.classList.add('txt-secondary');
      navLink.style.color = 'rgb(4, 217, 196)';
    });
    navLogo.classList.remove('txt-main');
    navLogo.classList.add('txt-secondary');
    dropdown.classList.remove('dropdownAccess');
  }else{
    navBarCus.classList.remove('navScroll')
    navBarCus.classList.add('navFixed')
    dropdown.classList.add('navFixed');
    dropdown.classList.remove('navScroll');
    dropdownCat.classList.add('navFixed');
    dropdownCat.classList.remove('navScroll');
    navLink.forEach(navLink => {
      navLink.classList.add('txt-main');
      navLink.classList.remove('txt-secondary');
      navLink.style.color = 'rgb(5, 119, 190)';
    });
    navLogo.classList.add('txt-main');
    navLogo.classList.remove('txt-secondary');
  }
})

