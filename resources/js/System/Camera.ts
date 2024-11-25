import { PerspectiveCamera, Scene } from 'three';

export class Camera {
  camera: PerspectiveCamera;

  constructor(scene: Scene, canvas: HTMLElement) {
    this.camera = new PerspectiveCamera(75, canvas.offsetWidth / canvas.offsetHeight, 0.1, 1000);
    this.camera.position.set(0, 2, 5); // Initial position
    scene.add(this.camera);

    // Adjust camera aspect ratio on resize
    window.addEventListener('resize', () => {
      this.camera.aspect = canvas.offsetWidth / canvas.offsetHeight;
      this.camera.updateProjectionMatrix();
    });
  }
}
