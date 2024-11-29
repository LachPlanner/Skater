import {
  Scene,
  WebGLRenderer,
  PerspectiveCamera,
  Object3D,
  AmbientLight,
  DirectionalLight,
} from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader';

export class Engine {
  scene: Scene;
  renderer: WebGLRenderer;
  camera: PerspectiveCamera;
  ambientLight: AmbientLight;
  directionalLight: DirectionalLight;
  orbitControls: OrbitControls;
  loader: GLTFLoader;
  canvas: HTMLElement;

  constructor(canvas: HTMLElement) {
    this.canvas = canvas;
    this.scene = new Scene();
    this.camera = new PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    this.renderer = new WebGLRenderer({ alpha: true });
    this.ambientLight = new AmbientLight(0x333333, 0);
    this.directionalLight = new DirectionalLight(0xffffff, 1);

    this.orbitControls = new OrbitControls(this.camera, this.renderer.domElement);
    this.orbitControls.enablePan = false;
    this.loader = new GLTFLoader();
  }

  public initialize() {
    //Set camera position
    this.camera.position.set(0, 5, 10); 
    this.camera.lookAt(0, 0, 0);

    //Setup renderer
    this.renderer.setSize(this.canvas.clientWidth, this.canvas.clientHeight);
    this.renderer.setPixelRatio(window.devicePixelRatio);

    this.canvas.appendChild(this.renderer.domElement);

    //Setup orbitControls
    this.orbitControls.minDistance = 1.1;
    this.orbitControls.maxDistance = 100.0;
    this.orbitControls.minPolarAngle = 0;
    this.orbitControls.maxPolarAngle = Math.PI / 2;

    //Setup light
    this.setupLight();

    this.render();

    window.addEventListener('resize', () => this.resize());
  }

  // Resize-handler
  public resize() {
    this.camera.aspect = this.canvas.offsetWidth / this.canvas.offsetHeight;
    this.camera.updateProjectionMatrix();
    this.renderer.setSize(this.canvas.offsetWidth, this.canvas.offsetHeight);
    this.render();
  }

  public get element(): HTMLElement {
    return this.renderer.domElement;
  }

  public render() {
    this.renderer.render(this.scene, this.camera);
  }

  public animate() {
    requestAnimationFrame(() => this.animate());
    this.renderer.render(this.scene, this.camera);
  }

  private setupLight() {
    this.scene.add(this.ambientLight);
    this.directionalLight.position.set(0, 10, 0);
    this.scene.add(this.directionalLight);
  }

  public loadModel(path: string): Promise<Object3D> {
    return new Promise((resolve, reject) => {
      this.loader.load(
        `/storage/${path}`,
        (gltf) => {
          const model = gltf.scene;
      
          model.position.set(0, 0, 0); // Flyt til centrum af scenen
          model.scale.set(1, 1, 1); // Skaler modellen til passende størrelse

          this.scene.add(model);
          this.render(); // Render scenen igen
          resolve(model);
        },
        undefined,
        (error) => {
          console.error('Error loading model:', error);
          reject(error);
        }
      );
    });
  }
}
