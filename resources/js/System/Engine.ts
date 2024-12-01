import {
  Scene,
  WebGLRenderer,
  PerspectiveCamera,
  Object3D,
  AmbientLight,
  DirectionalLight,
  TextureLoader,
  MeshStandardMaterial,
  Mesh
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
  textureLoader: TextureLoader;

  constructor(canvas: HTMLElement) {
    this.canvas = canvas;
    this.scene = new Scene();
    this.camera = new PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    this.renderer = new WebGLRenderer({ alpha: true, antialias: true });
    this.ambientLight = new AmbientLight(0x333333, 0);
    this.directionalLight = new DirectionalLight(0xffffff, 1);

    this.orbitControls = new OrbitControls(this.camera, this.renderer.domElement);
    this.orbitControls.enablePan = false;
    this.loader = new GLTFLoader();
    this.textureLoader = new TextureLoader();

  }

  public initialize() {
    //Set camera position
    this.camera.position.set(0, 2, 3); 
    
    this.camera.setViewOffset(this.canvas.clientWidth, this.canvas.clientHeight, 158, 0, this.canvas.clientWidth, this.canvas.clientHeight )

    //Setup renderer
    this.renderer.setSize(this.canvas.clientWidth, this.canvas.clientHeight);
    this.renderer.setPixelRatio(window.devicePixelRatio);

    this.canvas.appendChild(this.renderer.domElement);

    //Setup orbitControls
    this.orbitControls.minDistance = 1.1;
    this.orbitControls.maxDistance = 100.0;
    this.orbitControls.minPolarAngle = 0;
    this.orbitControls.maxPolarAngle = Math.PI / 2;
    this.orbitControls.target.set(0, 2, 0)

    //Setup light
    this.setupLight();

    this.render();

    window.addEventListener('resize', () => this.resize());
  }

  // Resize-handler
  public resize(): void {
    this.camera.aspect = this.canvas.offsetWidth / this.canvas.offsetHeight;
    this.camera.updateProjectionMatrix();
    this.renderer.setSize(this.canvas.offsetWidth, this.canvas.offsetHeight);
    this.render();
  }

  public get element(): HTMLElement {
    return this.renderer.domElement;
  }

  public render(): void {
    this.renderer.render(this.scene, this.camera);
  }

  public animate(): void {
    requestAnimationFrame(() => this.animate());
    this.renderer.render(this.scene, this.camera);
  }

  private setupLight(): void {
    this.scene.add(this.ambientLight);
    this.directionalLight.position.set(0, 10, 10);
    this.scene.add(this.directionalLight);
  }

  public async loadModel(path: string): Promise<Object3D> {
    return new Promise((resolve, reject) => {
        this.loader.load(
            `/storage/models/${path}.glb`,
            async (gltf) => {
                const model = gltf.scene;

                model.position.set(0, 0, 0);
                model.scale.set(1, 1, 1);

                model.userData = {
                    identifier: path,
                    loadedAt: new Date().toISOString(),
                };

                // Tilføj materialvariant og vent på, at den bliver tilføjet
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

  public get objects(): Array<Object3D> {
    return this.scene.children.filter(object => object.userData.identifier);
  }

  public getObjectByIdentifier(identifier: string): Object3D | null {
    let foundObject: Object3D | null = null;

    this.scene.traverse((object) => {
        if (object.userData.identifier === identifier) {
            foundObject = object;
        }
    });

    return foundObject;
  }
}
