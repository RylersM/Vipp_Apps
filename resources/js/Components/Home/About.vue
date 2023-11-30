<template>
  <!-- ====== About Section Start -->
  <section class="overflow-hidden pt-20 pb-12 lg:pt-[120px] lg:pb-[90px]">
    <div class="container mx-auto  px-5">
      <div class="-mx-4 flex flex-wrap items-center justify-between">
        <div class="w-full px-4 lg:w-6/12  slideleft " :class="{ 'slide-in': showContent }">
          <div class="-mx-3 flex items-center sm:-mx-4">
            <div class="relative my-4 z-[-1] ">
              <img :src="'/images/InterfaceWip.png'" alt=""
                class="w-full rounded-l shadow-2xl  " />
              <span class="absolute -right-7 -bottom-7 z-[-1]">
                <Icon name="moreicons" />
              </span>
            </div>
          </div>

          <!-- <div class="image">
            <div id="loupe" :style="loupeStyle"></div>
          </div> -->

        </div>
        <div class="w-full px-4 lg:w-1/2 xl:w-5/12 slideright " :class="{ 'slide-in': showContent }">
          <div class="mt-10 lg:mt-0">
            <h2 class="mb-6 text-3xl font-bold  sm:text-4xl md:text-[40px]">
                            Bienvenue dans l'univers des applications web, bienvenue chez nous.
                        </h2>
                        <span class="mb-3 block text-base font-semibold ">
                            Suivez un tutoriel pour comprendre le fonctionnement
                        </span>
                        <p class="mb-9 text-base leading-relaxed ">
                            Prêt à transformer votre expérience en ligne ? Parcourez notre store dès maintenant et laissez-vous surprendre par les possibilités infinies qui s'offrent à vous !
                        </p>
                        <a href="javascript:void(0)"
                            class="inline-block rounded-full border  bg-yellow-600 border-white py-3 px-9 text-base font-medium  hover:bg-yellow-500 text-white">
                            Parcourir
                        </a>


          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- ====== About Section End -->
</template>

<script setup>
import Icon from '@/Components/Icons/Icon.vue';
import { ref, onMounted, onBeforeUnmount } from 'vue';

const showContent = ref(false);

onMounted(() => {
  // Ajoute la classe "slide-in" après un court délai pour permettre le rendu initial
  setTimeout(() => {
    showContent.value = true;
  }, 100);
});

const zoom = 2;
const loupeStyle = ref({
  left: 0,
  top: 0,
  backgroundSize: '1500px',
  backgroundPosition: '-150px -150px',
});

const handleMouseMove = (event) => {
  loupeStyle.value.left = event.clientX + 'px';
  loupeStyle.value.top = event.clientY + 'px';
  loupeStyle.value.backgroundSize = `${1500 + zoom}px`;
  loupeStyle.value.backgroundPosition = `${-loupeRef.value.offsetLeft * zoom - 150}px ${-loupeRef.value.offsetTop * zoom - 150}px`;
};

let loupeRef;
onMounted(() => {
  loupeRef = document.getElementById('loupe');
  document.body.addEventListener('mousemove', handleMouseMove);
});

onBeforeUnmount(() => {
  document.body.removeEventListener('mousemove', handleMouseMove);
});


// zoom=2;
// document.body.onmousemove=function(){
//   loupe=document.getElementById("loupe");
//   loupe.style.left=event.clientX+"px";
//   loupe.style.top=event.clientY+"px";
//   loupe.style.backgroundSize=(1500 + zoom)+"px";
//   loupe.style.backgroundPosition=(-loupe.offsetLeft * zoom-150)+"px "+ (-loupe.offsetTop * zoom-150)+"px ";
// }



</script>

<style scope>
.image {

  margin: 0;
  min-height: 900px;
  min-width: 1500px;
  background-image: url('/images/users.png');
  background-size: contain;
  background-repeat: no-repeat;
}

.slideleft {
  transform: translateX(-22%);
  transition: transform 2s ease;
}

.slideright {
  transform: translateX(22%);
  transition: transform 2s ease;
}

.slide-in {
  transform: translateX(0%);
  transition: transform 2s ease;
}
</style>
