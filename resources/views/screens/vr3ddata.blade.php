@php
  $temples = \App\Temple::where('user_id', Auth::user()->id)->get();

  if ($temples->isEmpty()) {
      $temples = \App\Temple::where('user_id', 37)->get();
  }
@endphp

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@photo-sphere-viewer/core/index.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@photo-sphere-viewer/markers-plugin/index.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@photo-sphere-viewer/autorotate-plugin/index.min.css" />


<div id="viewer" style="width: 100%; height: 100vh;"></div>

<script type="importmap">
      {
          "imports": {
              "three": "https://cdn.jsdelivr.net/npm/three/build/three.module.js",
              "@photo-sphere-viewer/core": "https://cdn.jsdelivr.net/npm/@photo-sphere-viewer/core@5/index.module.js",
              "@photo-sphere-viewer/autorotate-plugin": "https://cdn.jsdelivr.net/npm/@photo-sphere-viewer/autorotate-plugin@5/index.module.js",
              "@photo-sphere-viewer/markers-plugin": "https://cdn.jsdelivr.net/npm/@photo-sphere-viewer/markers-plugin/index.module.js"
          }
      }
    </script>

<script type="module">
  import {
    Viewer,
    utils
  } from '@photo-sphere-viewer/core';
  import {
    AutorotatePlugin
  } from '@photo-sphere-viewer/autorotate-plugin';
  import {
    MarkersPlugin
  } from '@photo-sphere-viewer/markers-plugin';

  let current = 0;
  const temples = @json($temples);

  const imageUrl = "https://giapha.kennatech.vn//storage/" + temples[current].image;
  const markersData = JSON.parse(temples[current].markers);

  // console.log(markersData);

  const animatedValues = {
    pitch: {
      start: -Math.PI / 2,
      end: 0
    },
    yaw: {
      start: Math.PI / 2,
      end: 0
    },
    zoom: {
      start: 0,
      end: 50
    },
    maxFov: {
      start: 130,
      end: 90
    },
    fisheye: {
      start: 2,
      end: 0
    },
  };

  const viewer = new Viewer({
    container: document.querySelector('#viewer'),
    panorama: imageUrl,
    caption: temples[current].name,
    defaultPitch: animatedValues.pitch.start,
    defaultYaw: animatedValues.yaw.start,
    defaultZoomLvl: animatedValues.zoom.start,
    maxFov: animatedValues.maxFov.start,
    fisheye: animatedValues.fisheye.start,
    mousemove: false,
    mousewheel: false,
    plugins: [
      [AutorotatePlugin, {
        autostartDelay: null,
        autostartOnIdle: false,
        autorotateSpeed: '0.5rpm',
        // autorotatePitch: 0,
      }],
      [MarkersPlugin, {
        markers: markersData,
      }],
    ],
  });

  const markersPlugin = viewer.getPlugin(MarkersPlugin);

  // Hide markers initially
  function hideMarkers() {
    markersPlugin.setMarkers([]); // Set markers to an empty array to hide them
  }

  // Show markers
  function showMarkers() {
    markersPlugin.setMarkers(markersData);
  }

  markersPlugin.addEventListener('select-marker', ({
    marker
  }) => {
    console.log(`Clicked on marker ${marker.id}`);

    const markerId = marker.id; // Marker ID

    // Find the temple with the corresponding slug
    const foundTemple = temples.find(temple => temple.slug === markerId);

    if (foundTemple) {
      // Update the current temple index
      current = temples.indexOf(foundTemple);

      // Update the viewer with the new temple details
      const newImageUrl = "https://giapha.kennatech.vn//storage/" + foundTemple.image;
      const newMarkersData = JSON.parse(foundTemple.markers);

      viewer.setPanorama(newImageUrl, {
        speed: '20rpm',
        position: {
          yaw: 0,
          pitch: 0
        },
        caption: foundTemple.name,
        // more options in the API doc
      });

      // Update markers
      markersPlugin.setMarkers(newMarkersData);
    } else {
      console.error('Temple not found for marker id:', markerId);
    }
  });

  const autorotate = viewer.getPlugin(AutorotatePlugin);

  // autorotate.autorotateSpeed = 0.1047;

  let isInit = true;

  // setup timer for automatic animation on startup
  viewer.addEventListener('ready', () => {
    viewer.navbar.hide();

    // Hide markers before starting the intro animation
    hideMarkers();

    setTimeout(() => {
      if (isInit) {
        intro();
      }
    }, 5000);
  }, {
    once: true
  });

  viewer.addEventListener('click', ({
    data
  }) => {
    if (isInit) {
      intro();
    }
  });

  // perform the intro animation
  function intro() {
    isInit = false;
    autorotate.stop();
    viewer.navbar.hide();

    new utils.Animation({
      properties: {
        ...animatedValues,
        pitch: {
          start: animatedValues.pitch.start,
          // end: pitch
          end: -1
        },
        yaw: {
          start: animatedValues.yaw.start,
          // end: yaw
          end: 0
        },
      },
      duration: 2500,
      easing: 'inOutQuad',
      onTick: (properties) => {
        viewer.setOptions({
          fisheye: properties.fisheye,
          maxFov: properties.maxFov,
        });
        viewer.rotate({
          yaw: properties.yaw,
          pitch: properties.pitch
        });
        viewer.zoom(properties.zoom);
      },
    }).then(() => {
      // autorotate.autorotateSpeed = '1rpm';
      autorotate.start();
      viewer.navbar.show();
      viewer.setOptions({
        mousemove: true,
        mousewheel: true,
      });

      // Show markers after animation
      showMarkers();
    });
  };


  // Lay vi tri yawn va pitch
  // viewer.addEventListener('click', (event) => {
  //   const position = viewer.getPosition(); // Get current yaw and pitch
  //   console.log(`Yaw: ${position.yaw}, Pitch: ${position.pitch}`);
  // });
</script>
