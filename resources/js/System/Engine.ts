import {
  Scene,
  WebGLRenderer,
  PerspectiveCamera,
  Object3D,
} from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader';

export class Engine {
  scene: Scene;
  renderer: WebGLRenderer;
  camera: PerspectiveCamera;
  controls: OrbitControls;
  loader: GLTFLoader;

  constructor(container: HTMLElement) {
    if (!container) {
      throw new Error('Container element is null. Ensure the DOM element is available.');
    }

    // Opret scene
    this.scene = new Scene();

    // Opret renderer
    this.renderer = new WebGLRenderer({ antialias: true });
    this.renderer.setSize(container.offsetWidth, container.offsetHeight);
    this.renderer.setPixelRatio(window.devicePixelRatio);
    container.appendChild(this.renderer.domElement);

    // Opret kamera
    this.camera = new PerspectiveCamera(
      75,
      container.offsetWidth / container.offsetHeight,
      0.1,
      1000
    );
    this.camera.position.set(0, 2, 5);
    this.scene.add(this.camera);

    // Opret kontroller
    this.controls = new OrbitControls(this.camera, this.renderer.domElement);
    this.controls.enableDamping = true;

    // Opret loader
    this.loader = new GLTFLoader();

    // Tilføj resize-handler
    window.addEventListener('resize', () => this.resize(container));
  }

  // Start rendering loop
  public start() {
    const animate = () => {
      requestAnimationFrame(animate);
      this.controls.update(); // Opdater kontroller
      this.renderer.render(this.scene, this.camera);
    };
    animate();
  }

  // Resize-handler
  public resize(container: HTMLElement) {
    this.renderer.setSize(this.element.offsetWidth, this.element.offsetHeight);
    this.camera.aspect = this.element.offsetWidth / this.element.offsetHeight;
    this.camera.updateProjectionMatrix();
  }

  public reset(container: HTMLElement) {
    // Clear the scene
    this.scene.clear();

    // Dispose of renderer resources
    this.renderer.dispose();

    // Clear controls and reinitialize them
    this.controls.dispose();
    this.controls = new OrbitControls(this.camera, this.renderer.domElement);
    this.controls.enableDamping = true;

    // Recreate the renderer and append it to the container
    container.innerHTML = ''; // Remove the existing canvas
    this.renderer = new WebGLRenderer({ antialias: true });
    this.renderer.setSize(container.offsetWidth, container.offsetHeight);
    this.renderer.setPixelRatio(window.devicePixelRatio);
    container.appendChild(this.renderer.domElement);

    // Reset camera
    this.camera.aspect = container.offsetWidth / container.offsetHeight;
    this.camera.updateProjectionMatrix();
    this.camera.position.set(0, 2, 5);

    // Clear loader cache if necessary
    this.loader = new GLTFLoader();
  }

  // Loader metode til at tilføje modeller
  public loadModel(path: string, onLoad: (model: Object3D) => void) {
    this.loader.load(
      path,
      (gltf) => {
        const model = gltf.scene;
        this.scene.add(model);
        onLoad(model);
      },
      undefined,
      (error) => {
        console.error('An error occurred while loading the model:', error);
      }
    );
  }

  public get element(): HTMLElement {
    return this.renderer.domElement;
  }
}
