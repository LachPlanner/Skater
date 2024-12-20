import {
  Object3D,
  TextureLoader,
  Clock,
} from 'three';
import Scene from '@/System/Scene';
import PerspectiveCamera from '@/System/PerspectiveCamera';
import OrbitControls from '@/System/OrbitControls';
import Loader from '@/System/Loader';
import DirectionalLight from '@/System/Lighting/DirectionalLight';
import AmbientLight from '@/System/Lighting/AmbientLight';
import WebGLRenderer from '@/System/WebGLRenderer';
import Animation from '@/System/Animation';
import { SceneSetup } from '@/System/SceneSetup';

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
  animation: Animation; // Tilføjet til animationer
  clock: Clock; // Tilføjet for at beregne deltaTime
  sceneSetup: SceneSetup

  constructor(canvas: HTMLElement) {
    this.canvas = canvas;
    this.scene = new Scene();
    this.camera = new PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    this.renderer = new WebGLRenderer(true, true);
    this.ambientLight = new AmbientLight(this, 0xffffff, 1);
    this.directionalLight = new DirectionalLight(this);

    this.orbitControls = new OrbitControls(this.camera, this.renderer.domElement);
    this.orbitControls.enablePan = false;
    this.loader = new Loader(this);
    this.textureLoader = new TextureLoader();
    this.animation = new Animation();
    this.clock = new Clock();
    this.sceneSetup = new SceneSetup(this.renderer, this.camera, this.orbitControls, this.canvas);

    this.initializeResizeListener();
  }

  private initializeResizeListener(): void {
    window.addEventListener('resize', () => this.resize());
  }

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

    const deltaTime = this.clock.getDelta();
    this.animation.updateAnimations(deltaTime);

    this.render();
  }

  public get objects(): Array<Object3D> {
    return this.scene.children.filter((object) => object.userData.identifier);
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

