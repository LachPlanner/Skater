import { Scene, WebGLRenderer, Camera } from 'three';

export class Engine {
  scene: Scene;
  renderer: WebGLRenderer;

  constructor(container: HTMLElement) {
    // Create scene
    this.scene = new Scene();

    // Create renderer
    this.renderer = new WebGLRenderer({ antialias: true });
    this.renderer.setSize(container.offsetWidth, container.offsetHeight);
    container.appendChild(this.renderer.domElement);

    // Adjust renderer on resize
    window.addEventListener('resize', () => {
      this.renderer.setSize(container.offsetWidth, container.offsetHeight);
    });
  }

  // Start animation loop
  start(camera: Camera) {
    const animate = () => {
      requestAnimationFrame(animate);
      this.renderer.render(this.scene, camera);
    };
    animate();
  }
}
