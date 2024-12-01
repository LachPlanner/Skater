import {
  Object3D,
  TextureLoader,
} from 'three';
import Scene from '@/System/Scene';
import PerspectiveCamera from '@/System/PerspectiveCamera';
import OrbitControls from '@/System/OrbitControls';
import Loader from '@/System/Loader';
import DirectionalLight from '@/System/Lighting/DirectionalLight';
import AmbientLight from '@/System/Lighting/AmbientLight';
import WebGLRenderer from '@/System/WebGLRenderer';

export class Engine {
  scene: Scene;
  renderer: WebGLRenderer;
  camera: PerspectiveCamera;
  ambientLight: AmbientLight;
  directionalLight: DirectionalLight;
  orbitControls: OrbitControls;
  loader: Loader;
  canvas: HTMLElement;
  textureLoader: TextureLoader;

  constructor(canvas: HTMLElement) {
    this.canvas = canvas;
    this.scene = new Scene();
    this.camera = new PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    this.renderer = new WebGLRenderer(true, true);
    this.ambientLight = new AmbientLight(this);
    this.directionalLight = new DirectionalLight(this);

    this.orbitControls = new OrbitControls(this.camera, this.renderer.domElement);
    this.orbitControls.enablePan = false;
    this.loader = new Loader(this);
    this.textureLoader = new TextureLoader();

  }

  public initialize() {
    //Set camera position
    this.camera.position.set(0, 2, 4); 
    
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
    this.orbitControls.enableZoom = false;

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
