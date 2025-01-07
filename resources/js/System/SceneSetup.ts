import WebGLRenderer from "./WebGLRenderer";
import PerspectiveCamera from "./PerspectiveCamera";
import OrbitControls from "./OrbitControls";

export class SceneSetup {
  private renderer: WebGLRenderer;
  private camera: PerspectiveCamera;
  private orbitControls: OrbitControls;
  private canvas: HTMLElement;

  constructor(renderer: WebGLRenderer, camera: PerspectiveCamera, orbitControls: OrbitControls, canvas: HTMLElement) {
    this.renderer = renderer;
    this.camera = camera;
    this.orbitControls = orbitControls;
    this.canvas = canvas;
  }

  public initialize(sceneConfig: number): void {
    // Renderer settings
    this.renderer.setSize(this.canvas.clientWidth, this.canvas.clientHeight);
    this.renderer.setPixelRatio(window.devicePixelRatio);
    this.canvas.appendChild(this.renderer.domElement);

    // Scene configuration based on sceneConfig
    switch (sceneConfig) {
      case 1:
        this.setupScene1();
        break;
      case 2:
        this.setupScene2();
        break;
      case 3:
        this.setupScene3();
        break;
      case 4:
        this.setupScene4();
        break;
      default:
        console.warn('Unknown scene configuration:', sceneConfig);
    }
  }

  private setupScene1(): void {
    this.camera.position.set(0, 2, 4);
    this.orbitControls.minDistance = 0.5;
    this.orbitControls.maxDistance = 10.0;
    this.orbitControls.minPolarAngle = 0;
    this.orbitControls.maxPolarAngle = Math.PI / 2;
    this.orbitControls.target.set(0, 2, 0);
    this.orbitControls.enableZoom = false;
  }

  private setupScene2(): void {
    this.camera.position.set(0, -0.1, 0.8);
    this.camera.lookAt(-1, -0.1, 0);
    this.orbitControls.minDistance = 0.5;
    this.orbitControls.maxDistance = 10.0;
    this.orbitControls.minPolarAngle = 0;
    this.orbitControls.maxPolarAngle = Math.PI / 2;
    this.orbitControls.target.set(-1, -0.1, 0);
    this.orbitControls.enableZoom = false;
  }

  private setupScene3(): void {
    this.camera.position.set(-1.05, -0.27, 1);
    this.camera.lookAt(-1, -0.3, 0.3);
    this.orbitControls.minDistance = 0.5;
    this.orbitControls.maxDistance = 10.0;
    this.orbitControls.minPolarAngle = 0;
    this.orbitControls.maxPolarAngle = Math.PI / 2;
    this.orbitControls.target.set(-1, -0.3, 0.3);
    this.orbitControls.updateAzimuthAngle(45 * (Math.PI / 180));
    this.orbitControls.enableZoom = false;
  }

  private setupScene4(): void {
    this.camera.position.set(0, -4, 0);
    this.camera.rotation.set(Math.PI, 0, 0);
    this.camera.lookAt(0, 0, 0);
    this.orbitControls.minDistance = 0.5;
    this.orbitControls.maxDistance = 10.0;
  }
}
