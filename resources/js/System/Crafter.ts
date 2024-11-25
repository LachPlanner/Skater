import { Engine } from './Engine';
import { Camera } from './Camera';
import { OrbitControls } from './OrbitControls';
import { Loader } from './Loader';

export class Crafter {
  engine: Engine;
  camera: Camera;
  controls: OrbitControls;
  loader: Loader;

  constructor(container: HTMLElement) {
    // Start engine
    this.engine = new Engine(container);

    // Setup camera
    this.camera = new Camera(this.engine.scene, this.engine.renderer.domElement);

    // Setup controls
    this.controls = new OrbitControls(this.camera.camera, this.engine.renderer.domElement);

    // Setup loader
    this.loader = new Loader(this.engine.scene);

    // Start rendering loop
    this.engine.start(this.camera.camera);
  }
}
