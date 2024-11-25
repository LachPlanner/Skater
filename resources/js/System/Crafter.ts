import { Engine } from './Engine';

export class Crafter {
  private static instance: Crafter | null = null;
  engine: Engine;

  private constructor(container: HTMLElement) {
    this.engine = new Engine(container);
    this.engine.start();
  }

  static getInstance(container: HTMLElement): Crafter {
    if (!Crafter.instance) {
      Crafter.instance = new Crafter(container);
    } else {
      Crafter.instance.engine.reset(container);
    }
    return Crafter.instance;
  }
}

