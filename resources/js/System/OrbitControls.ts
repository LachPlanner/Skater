import { OrbitControls as ThreeOrbitControls } from 'three/examples/jsm/controls/OrbitControls';
import { PerspectiveCamera } from 'three';

export class OrbitControls {
  controls: ThreeOrbitControls;

  constructor(camera: PerspectiveCamera, domElement: HTMLElement) {
    this.controls = new ThreeOrbitControls(camera, domElement);
    this.controls.enableDamping = true; // Smooth movement
  }
}
